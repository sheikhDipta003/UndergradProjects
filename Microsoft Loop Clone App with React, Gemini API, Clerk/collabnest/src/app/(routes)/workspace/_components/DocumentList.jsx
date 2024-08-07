import Image from "next/image";
import { useRouter } from "next/navigation";
import React from "react";
import DocumentOptions from "./DocumentOptions";
import { doc, deleteDoc } from "firebase/firestore";
import { db } from "../../../../../config/firebaseConfig";

function DocumentList({ documentList, params }) {
  const router = useRouter();

  const deleteDocument = async (docId) => {
    await deleteDoc(doc(db, 'workspaceDocuments', docId));
    await deleteDoc(doc(db, 'documentOutput', docId));
    router.push("/workspace/" + params?.workspaceid);
  }

  return (
    <section>
      {documentList.map((doc, index) => (
        <section
          key={index}
          onClick={() =>
            router.push("/workspace/" + params?.workspaceid + "/" + doc?.id)
          }
          className={`mt-3 p-2 px-3 hover:bg-gray-200 rounded-lg cursor-pointer flex justify-between items-center ${
            doc.id === params?.documentid && "bg-white"
          }`}
        >
          <div className="flex gap-2 items-center">
            {!doc.emoji && (
              <Image
                src={"/document.svg"}
                width={20}
                height={20}
                alt="document"
              />
            )}
            <h2 className="flex gap-2">
              {doc?.emoji} {doc.documentName}
            </h2>
          </div>
          <DocumentOptions doc={doc} deleteDocument={(docId) => deleteDocument(docId)}/>
        </section>
      ))}
    </section>
  );
}

export default DocumentList;
