// app.js -- shared logic for CoinSpare demo (localStorage-based)
// IMPORTANT: This is demo-only. Replace localStorage with Firebase/DB for production.

// Utilities
function qs(name, url = location.href) {
  name = name.replace(/[[]]/g, "\\$&");
  const r = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
        results = r.exec(url);
  if (!results) return null;
  if (!results[2]) return '';
  return decodeURIComponent(results[2].replace(/\+/g, " "));
}

function now() { return new Date().toLocaleString(); }
function randCode(prefix='CS') {
  // generate short unique code e.g., CS7F4A2
  const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
  let c;
  do {
    c = prefix + Array.from({length:6}).map(()=>chars[Math.floor(Math.random()*chars.length)]).join('');
  } while(getUserByRef(c));
  return c;
}

// Data helpers
function getAllUsers() {
  return JSON.parse(localStorage.getItem('cs_users') || '[]');
}
function saveAllUsers(list) {
  localStorage.setItem('cs_users', JSON.stringify(list));
}
function getUserByEmail(email){
  return getAllUsers().find(u => u.email === (email||'').toLowerCase());
}
function getUserByRef(code){
  return getAllUsers().find(u => u.refCode === code);
}
function currentUser(){
  return JSON.parse(localStorage.getItem('cs_currentUser') || 'null');
}
function setCurrentUser(u){ localStorage.setItem('cs_currentUser', JSON.stringify(u)); }
function logoutAndRedirect(to='login.html'){ localStorage.removeItem('cs_currentUser'); location.href = to; }

// Ensure admin exists (on first load)
(function ensureAdmin(){
  const users = getAllUsers();
  if(!users.find(u=>u.email==='admin@coinspare.com')){
    users.push({
      name: "Administrator",
      email: "admin@coinspare.com",
      password: "admin123",
      role: "admin",
      refCode: "CSADMIN",
      refBy: null,
      team: [],
      portfolio: { balance: 500000, invested: 0, profitLoss: 0, trades: [] },
      status: "active",
      createdAt: now()
    });
    saveAllUsers(users);
  }
})();

// Auth functions used by pages
function registerUser({name,email,password,refCode}){
  email = email.toLowerCase();
  const users = getAllUsers();
  if(getUserByEmail(email)) return { ok:false, msg: 'Email already registered' };
  // refCode must exist (force referral-only registration)
  const referrer = getUserByRef(refCode);
  if(!referrer) return { ok:false, msg: 'Invalid referral code' };

  const myRef = randCode('CS');
  const newUser = {
    name, email, password, role: 'user', refCode: myRef, refBy: refCode,
    team: [], portfolio: { balance: 10000, invested: 0, profitLoss: 0, trades: [] },
    status: 'active', createdAt: now()
  };
  users.push(newUser);

  // add to referrer's team
  const idx = users.findIndex(u => u.email === referrer.email);
  if(idx !== -1){
    users[idx].team = users[idx].team || [];
    users[idx].team.push({ email, name, at: now() });
  }

  saveAllUsers(users);
  return { ok:true, user: newUser };
}

function loginUser({email,password}){
  email = email.toLowerCase();
  const u = getUserByEmail(email);
  if(!u) return { ok:false, msg: 'User not found' };
  if(u.password !== password) return { ok:false, msg: 'Wrong password' };
  if(u.status && u.status !== 'active') return { ok:false, msg: 'Account not active' };
  setCurrentUser(u);
  return { ok:true, user:u };
}

// Trade helper
function placeTrade(userEmail, {asset, amount}){
  const users = getAllUsers();
  const i = users.findIndex(u => u.email === userEmail);
  if(i === -1) return { ok:false, msg:'User missing' };
  const u = users[i];
  const pf = u.portfolio || { balance: 0, invested:0, profitLoss:0, trades: []};
  if(amount > pf.balance) return { ok:false, msg: 'Insufficient balance' };
  pf.balance -= amount;
  pf.invested += amount;
  const trade = { asset, amount, date: now() };
  pf.trades.unshift(trade);
  // simple dummy P/L change
  pf.profitLoss = Math.round((Math.random()*200 - 50));
  users[i].portfolio = pf;
  saveAllUsers(users);
  // if the current logged in user is this user, update session copy
  const cur = currentUser();
  if(cur && cur.email === userEmail){ setCurrentUser(users[i]); }
  return { ok:true, trade };
}

// Utility for admin to aggregate all trades
function allTradesFlatten(){
  const users = getAllUsers();
  let arr = [];
  users.forEach(u=>{
    (u.portfolio && u.portfolio.trades || []).forEach(t=>{
      arr.push({ user: u.name, email: u.email, ...t});
    });
  });
  arr.sort((a,b)=> new Date(b.date) - new Date(a.date));
  return arr;
}
