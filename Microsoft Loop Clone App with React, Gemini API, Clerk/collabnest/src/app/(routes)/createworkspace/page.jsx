"use client";
import CoverPicker from "../../_components/CoverPicker";
import EmojiPickerComponent from "../../_components/EmojiPickerComponent";
import { Button } from "../../../components/ui/button";
import { Input } from "../../../components/ui/input";
import { doc, setDoc } from "firebase/firestore";
import { Loader2Icon, SmilePlus } from "lucide-react";
import Image from "next/image";
import React, { useState } from "react";
import { db } from "../../../../config/firebaseConfig";
import { useAuth, useUser } from "@clerk/nextjs";
import { useRouter } from "next/navigation";
import uuid4 from "uuid4";

function page() {
  const [coverImage, setCoverImage] = useState("/cover.png");
  const [workspaceName, setWorkspaceName] = useState("");
  const [emoji, setEmoji] = useState();
  const { user } = useUser();
  const { orgId } = useAuth();
  const [loading, setLoading] = useState(false);
  const router = useRouter();

  // insert new workspace data into Firebase DB
  const OnCreateWorkspace = async () => {
    setLoading(true);

    const workspaceId = Date.now();
    await setDoc(doc(db, "Workspace", workspaceId.toString()), {
      workspaceName: workspaceName,
      emoji: emoji,
      coverImage: coverImage,
      createdBy: user?.primaryEmailAddress?.emailAddress,
      id: workspaceId,
      orgId: orgId ? orgId : user?.primaryEmailAddress?.emailAddress,
    });

    // One workspace can contain multiple 'document's. In this sense, 'document' is different from Firebase definition of documents
    const docId = uuid4();
    await setDoc(doc(db, 'workspaceDocuments', docId.toString()), {
      workspaceId: workspaceId,
      emoji: null,
      coverImage: null,
      createdBy: user?.primaryEmailAddress?.emailAddress,
      id: docId,
      documentName: 'Untitled Document',
      documentOutput: []
    });
    //This is the default 'document' created when a new workspace is created, contains both doc and workspace related info

    await setDoc(doc(db, 'documentOutput', docId.toString()), {
      docId : docId,
      output: []
    })
    //and, this firebase document contains only 'document'-specific info, that is, the content of the 'document' that the user writes to the right side in the workspace page
    
    setLoading(false);
    router.replace('/workspace/' + workspaceId + "/" + docId);
  };

  return (
    <main className="p-10 md:px-36 lg:px-64 xl:px-96 py-28">
      <article className="shadow-2xl rounded-xl">
        {/* Cover image */}
        <CoverPicker setNewCover={(v) => setCoverImage(v)}>
          <section className="relative group cursor-pointer">
            <h2 className="hidden absolute w-full h-full group-hover:flex items-center justify-center p-4">
              Change Cover
            </h2>
            <div className="group-hover:opacity-40">
              <Image
                src={coverImage}
                width={400}
                height={400}
                className="w-full h-[120px] object-cover rounded-t-xl"
                alt="cover"
                priority={true}
              />
            </div>
          </section>
        </CoverPicker>

        {/* Input Section */}
        <section className="p-12">
          <h2 className="font-medium text-xl">Create a new workspace</h2>
          <h2 className="text-sm mt-2">
            This is a shared space where you can collaborate with your team. You
            can always rename it later.
          </h2>
          <div className="mt-8 flex gap-2 items-center">
            <EmojiPickerComponent setEmojiIcon={(v) => setEmoji(v)}>
              <Button variant="outline">{emoji ? emoji : <SmilePlus />}</Button>
            </EmojiPickerComponent>
            <Input
              placeholder="Workspace Name"
              onChange={(e) => setWorkspaceName(e.target.value)}
            />
          </div>
          <div className="mt-7 flex justify-end gap-6">
            <Button
              disabled={!workspaceName.length || loading}
              onClick={OnCreateWorkspace}
            >
              Create {loading && <Loader2Icon className="animate-spin ml-2" />}
            </Button>
            <Button variant="destructive">Cancel</Button>
          </div>
        </section>
      </article>
    </main>
  );
}

export default page;
