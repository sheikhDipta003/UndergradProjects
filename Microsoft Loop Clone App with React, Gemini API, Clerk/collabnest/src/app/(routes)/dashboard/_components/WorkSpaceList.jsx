"use client";
import React, { useEffect, useState } from "react";
import { Button } from "@/components/ui/button";
import { useAuth, useUser } from "@clerk/nextjs";
import { LayoutGrid, AlignLeft } from "lucide-react";
import Image from "next/image";
import Link from "next/link";
import WorkspaceItemList from "./WorkspaceItemList";
import { collection, getDocs, query, where } from "firebase/firestore";
import { db } from "../../../../../config/firebaseConfig";

function WorkSpaceList() {
  const { user } = useUser();
  const { orgId } = useAuth();
  const [ workspaceList, setWorkspaceList ] = useState([]);

  useEffect(() => {
    user && getWorkspaceList();
  }, [orgId, user]);

  const getWorkspaceList = async () => {
    setWorkspaceList([]);
    const q = query(
      collection(db, "Workspace"),
      where(
        "orgId",
        "==",
        orgId ? orgId : user?.primaryEmailAddress?.emailAddress
      )
    );
    const querySnapshot = await getDocs(q);
    querySnapshot.forEach((doc) => {
      setWorkspaceList((prev) => [...prev, doc.data()]);
    });
  };

  return (
    <article className="my-10 p-10 md:px-24 lg:px-36 xl:px-52">
      <section className="flex justify-between">
        <h2 className="font-bold text-2xl">Hello, {user?.fullName}</h2>
        <Link href={"/createworkspace"}>
          <Button>+</Button>
        </Link>
      </section>
      <section className="mt-10 flex justify-between">
        <section>
          <h2 className="font-medium text-primary">Workspaces</h2>
        </section>
        <section className="flex gap-2">
          <LayoutGrid />
          <AlignLeft />
        </section>
      </section>
      {workspaceList === undefined || workspaceList.length === 0 ? (
        <section className="flex flex-col justify-center items-center mt-10">
          <Image
            src={"/workspace.png"}
            width={200}
            height={200}
            alt="workspace"
          />
          <h2>Create a workspace</h2>
          <Link href={"/createworkspace"}>
            <Button className="my-3">+ New Workspace</Button>
          </Link>
        </section>
      ) : (
        <section>
          <WorkspaceItemList workspaceList={workspaceList} />
        </section>
      )}
    </article>
  );
}

export default WorkSpaceList;
