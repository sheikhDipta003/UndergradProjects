"use client";
import CoverPicker from "@/app/_components/CoverPicker";
import React, { useEffect, useState } from "react";
import Image from "next/image";
import { SmilePlus } from "lucide-react";
import EmojiPickerComponent from "@/app/_components/EmojiPickerComponent";
import { doc, getDoc, updateDoc } from "firebase/firestore";
import { db } from "../../../../../config/firebaseConfig";
import { toast } from "sonner";

function DocumentInfo({ params }) {
  const [coverImage, setCoverImage] = useState("/cover.png");
  const [emoji, setEmoji] = useState();
  const [documentInfo, setDocumentInfo] = useState();

  useEffect(() => {
    params && getDocumentInfo();
  }, [params]);

  //get the info of the document
  const getDocumentInfo = async () => {
    const result = await getDoc(
      doc(db, "workspaceDocuments", params?.documentid)
    );
    if (result.exists()) {
      setDocumentInfo(result.data());
      setEmoji(result.data()?.emoji);
      result.data()?.coverImage && setCoverImage(result.data()?.coverImage);
    }
  };

  //update document info
  const updateDocumentInfo = async (key, value) => {
    await updateDoc(doc(db, "workspaceDocuments", params?.documentid), {
      [key]: value,
    });
    toast("Document Updated!");
  };

  return (
    <section>
      {/* Cover */}
      <CoverPicker
        setNewCover={(v) => {
          setCoverImage(v);
          updateDocumentInfo("coverImage", v);
        }}
      >
        <section className="relative group cursor-pointer">
          <h2 className="hidden absolute w-full h-full group-hover:flex items-center justify-center p-4">
            Change Cover
          </h2>
          <div className="group-hover:opacity-40">
            <Image
              src={coverImage}
              width={400}
              height={400}
              className="w-full h-[200px] object-cover rounded-t-xl"
              alt="cover"
              priority={true}
            />
          </div>
        </section>
      </CoverPicker>

      {/* Emoji Picker */}
      <div className="absolute ml-10 mt-[-40px] cursor-pointer">
        <EmojiPickerComponent
          setEmojiIcon={(v) => {
            setEmoji(v);
            updateDocumentInfo("emoji", v);
          }}
        >
          <section className="bg-[#ffffffb0] p-4 rounded-md">
            {emoji ? (
              <span className="text-5xl">{emoji}</span>
            ) : (
              <SmilePlus className="h-10 w-10 text-gray-500" />
            )}
          </section>
        </EmojiPickerComponent>
      </div>

      {/* File Name */}
      <div className="mt-10 p-10">
        <input
          type="text"
          className="font-bold text-4xl outline-none"
          placeholder="Untitled Document"
          defaultValue={documentInfo?.documentName}
          onBlur={(e) => updateDocumentInfo('documentName', e.target.value)}
        />
      </div>
    </section>
  );
}

export default DocumentInfo;
