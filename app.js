import { initializeApp } from "https://www.gstatic.com/firebasejs/10.12.0/firebase-app.js";
import { getAuth, createUserWithEmailAndPassword, signInWithEmailAndPassword, signOut, onAuthStateChanged } from "https://www.gstatic.com/firebasejs/10.12.0/firebase-auth.js";
import { getFirestore, setDoc, doc, getDoc, getDocs, collection, query, where } from "https://www.gstatic.com/firebasejs/10.12.0/firebase-firestore.js";

// ✅ Firebase Config
const firebaseConfig = {
  apiKey: "AIzaSyBxIujPFlHfqgL_-fLbsoSYo3gaGf2iPHQ",
  authDomain: "sabjiwalahere.firebaseapp.com",
  projectId: "sabjiwalahere",
  storageBucket: "sabjiwalahere.firebasestorage.app",
  messagingSenderId: "418578879301",
  appId: "1:418578879301:web:56bdf323bf186cbbe1a42c",
  measurementId: "G-4DGEQXXDLG"
};

const app = initializeApp(firebaseConfig);
const auth = getAuth(app);
const db = getFirestore(app);

// 🔹 Generate Referral Code
function generateReferral(name) {
  return name.substring(0, 3).toUpperCase() + Math.floor(1000 + Math.random() * 9000);
}

// 🔹 Register
const regForm = document.getElementById("registerForm");
if (regForm) {
  regForm.addEventListener("submit", async (e) => {
    e.preventDefault();
    const name = document.getElementById("name").value;
    const email = document.getElementById("email").value;
    const password = document.getElementById("password").value;
    const phone = document.getElementById("phone").value;
    const referredBy = document.getElementById("referredBy").value;

    if (!referredBy) { alert("Referral is required!"); return; }

    try {
      const userCredential = await createUserWithEmailAndPassword(auth, email, password);
      const uid = userCredential.user.uid;
      const referralCode = generateReferral(name);

      await setDoc(doc(db, "users", uid), {
        name, email, phone,
        referralCode,
        referredBy,
        walletBalance: 0,
        createdAt: new Date().toISOString()
      });

      alert("Registered Successfully!");
      window.location.href = "dashboard.html";
    } catch (err) {
      alert(err.message);
    }
  });
}

// 🔹 Login
const loginForm = document.getElementById("loginForm");
if (loginForm) {
  loginForm.addEventListener("submit", async (e) => {
    e.preventDefault();
    const email = document.getElementById("loginEmail").value;
    const password = document.getElementById("loginPassword").value;
    try {
      await signInWithEmailAndPassword(auth, email, password);
      window.location.href = "dashboard.html";
    } catch (err) {
      alert(err.message);
    }
  });
}

// 🔹 Dashboard Data
if (window.location.pathname.includes("dashboard.html")) {
  onAuthStateChanged(auth, async (user) => {
    if (user) {
      const uid = user.uid;
      const docRef = doc(db, "users", uid);
      const snap = await getDoc(docRef);

      if (snap.exists()) {
        const data = snap.data();
        document.getElementById("userName").innerText = data.name;
        document.getElementById("refCode").innerText = data.referralCode;
        document.getElementById("walletBalance").innerText = data.walletBalance;

        // Fetch team
        const q = query(collection(db, "users"), where("referredBy", "==", data.referralCode));
        const teamSnap = await getDocs(q);
        const teamList = document.getElementById("teamList");
        teamSnap.forEach((doc) => {
          const li = document.createElement("li");
          li.innerText = doc.data().name + " (" + doc.data().email + ")";
          teamList.appendChild(li);
        });
      }
    } else {
      window.location.href = "login.html";
    }
  });
}

// 🔹 Admin Panel
if (window.location.pathname.includes("admin.html")) {
  const list = document.getElementById("allUsers");
  const snap = await getDocs(collection(db, "users"));
  snap.forEach((docu) => {
    const li = document.createElement("li");
    li.innerText = docu.data().name + " - " + docu.data().email + " (Ref: " + docu.data().referralCode + ")";
    list.appendChild(li);
  });
}

// 🔹 Logout
window.logoutUser = async function() {
  await signOut(auth);
  window.location.href = "login.html";
};
