"use client";
import React, { useEffect } from "react";
import Logo from "../../../_components/Logo";
import { OrganizationSwitcher, UserButton, useAuth, useUser } from "@clerk/nextjs";
import { doc, setDoc } from "firebase/firestore";
import { db } from "../../../../../config/firebaseConfig";

function Header() {
  const { orgId } = useAuth();
  const {user} = useUser();

  useEffect(() => {
    user && saveUserData();
  }, [user]);

  // save user data after the user has logged in and navigated to the dashboard page
  const saveUserData = async () => {
    const docId = user?.primaryEmailAddress?.emailAddress;  //use email as docId so that duplicate id won't be created for a user
    try {
      await setDoc(doc(db, 'collabNestUsers', docId), {
        name: user?.fullName,
        avatar: user?.imageUrl,
        email: docId
      })
    } catch (err) {
      console.log('Failed to save user data = ', err);
    }
  }

  return (
    <div className="flex justify-between items-center p-3 shadow-sm">
      <Logo />
      <OrganizationSwitcher
        afterCreateOrganizationUrl={"/dashboard"}
        afterLeaveOrganizationUrl={"/dashboard"}
      />
      <UserButton />
    </div>
  );
}

export default Header;
