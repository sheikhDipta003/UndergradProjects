"use client";
import Logo from "@/app/_components/Logo";
import { Button } from "@/components/ui/button";
import {
  collection,
  onSnapshot,
  query,
  doc,
  setDoc,
  where,
} from "firebase/firestore";
import { Bell, Loader2Icon } from "lucide-react";
import React, { useEffect, useState } from "react";
import { db } from "../../../../../config/firebaseConfig";
import DocumentList from "./DocumentList";
import uuid4 from "uuid4";
import { useUser } from "@clerk/nextjs";
import { useRouter } from "next/navigation";
import { Progress } from "@/components/ui/progress";
import { toast } from "sonner";

const MAX_FILE=process.env.NEXT_PUBLIC_MAX_FILE_COUNT;

function SideNav({ params }) {
  const [documentList, setDocumentList] = useState([]);
  const { user } = useUser();
  const [loading, setLoading] = useState(false);
  const router = useRouter();

  useEffect(() => {
    params && getDocumentList();
  }, [params]);

  // get document list of a particular workspace for a particular user
  const getDocumentList = () => {
    const q = query(
      collection(db, "workspaceDocuments"),
      where("workspaceId", "==", Number(params?.workspaceid))
    );

    setDocumentList([]);
    // Otherwise, multiple documents will be shown momentarily after clicking on the plus icon once

    const unsubscribe = onSnapshot(q, (querySnapshot) => {
      querySnapshot.forEach((doc) => {
        setDocumentList((documentList) => [...documentList, doc.data()]);
      });
    }); //'unsubscribe' -> if we don't want to 'subscribe to' this snapshot, use this object that is returned by OnSnapshot func
  };

  const createNewDocument = async () => {
    if(documentList?.length >= MAX_FILE){
      toast("Upgrade to add new file", {
        description: "You reached max file limit, please upgrade to get unlimited file creation",
        action: {
          label: "Upgrade",
          onClick: () => console.log("Upgrade"),
        },
      });
      return;
    }

    setLoading(true);

    const docId = uuid4();
    await setDoc(doc(db, "workspaceDocuments", docId.toString()), {
      workspaceId: Number(params?.workspaceid),
      emoji: null,
      coverImage: null,
      createdBy: user?.primaryEmailAddress?.emailAddress,
      id: docId,
      documentName: "Untitled Document",
      documentOutput: [],
    });
    //This is the default 'document' created when a new workspace is created, contains both doc and workspace related info

    await setDoc(doc(db, 'documentOutput', docId.toString()), {
      docId : docId,
      output: []
    })
    //and, this firebase document contains only 'document'-specific info, that is, the content of the 'document' that the user writes to the right side in the workspace page
    
    setLoading(false);
    router.replace("/workspace/" + params?.workspaceid + "/" + docId);
  };

  return (
    <article className="h-screen md:w-72 hidden md:block fixed bg-blue-50 p-5 shadow-md">
      <section className="flex justify-between items-center">
        <Logo />
        <Bell className="h-5 w-5 text-gray-500" />
      </section>

      <hr className="my-5" />

      <section>
        <div className="flex justify-between items-center">
          <h2 className="font-medium">Workspace Name</h2>
          <Button size="sm" onClick={createNewDocument}>
            {loading ? <Loader2Icon className="h-4 w-4 animate-spin" /> : "+"}
          </Button>
        </div>
      </section>

      {/* Document List */}
      <DocumentList documentList={documentList} params={params} />

      {/* Progress Bar */}
      <section className="absolute bottom-10 w-[85%]">
        <Progress value={(documentList?.length / MAX_FILE)*100} />
        <h2 className="text-sm font-light my-2">
          <strong>{documentList.length}</strong> out of <strong>5</strong> Files
          used
        </h2>
        <h2 className="text-sm font-light">
          Upgrade your plan for unlimited access
        </h2>
      </section>
    </article>
  );
}

export default SideNav;
