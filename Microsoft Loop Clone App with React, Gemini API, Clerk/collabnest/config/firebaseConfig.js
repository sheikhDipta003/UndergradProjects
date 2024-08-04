// Import the functions you need from the SDKs you need
import { initializeApp } from "firebase/app";
// TODO: Add SDKs for Firebase products that you want to use
// https://firebase.google.com/docs/web/setup#available-libraries
import {getFirestore} from 'firebase/firestore';

// Your web app's Firebase configuration
const firebaseConfig = {
  apiKey: process.env.NEXT_PUBLIC_FIREBASE_API_KEY,
  authDomain: "personal-projects-40be9.firebaseapp.com",
  projectId: "personal-projects-40be9",
  storageBucket: "personal-projects-40be9.appspot.com",
  messagingSenderId: "281404870880",
  appId: "1:281404870880:web:14ba9f68fc77fa3fa7c085",
};

// Initialize Firebase
export const app = initializeApp(firebaseConfig);
export const db = getFirestore(app);