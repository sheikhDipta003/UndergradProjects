import React, { useState } from "react";
import DocumentHeader from "./DocumentHeader";
import DocumentInfo from "./DocumentInfo";
import RichDocumentEditor from "./RichDocumentEditor";
import { Button } from "@/components/ui/button";
import { MessageCircle, X } from "lucide-react";
import CommentBox from "./CommentBox";

function DocumentEditorSection({ params }) {
  const [openComment, setOpenComment] = useState(false);

  return (
    <article>
      {/* Header */}
      <DocumentHeader />

      {/* Document Info - Cover, Emoji Picker, File Name */}
      {/* params.workspaceid, params.documentid : obtained via dynamic route*/}
      <DocumentInfo params={params} />

      {/* Rich Document Editor */}
      <div className="grid grid-cols-4">
        <div className="col-span-3">
          <RichDocumentEditor params={params} />
        </div>

        {/* Comment */}
        <section className="fixed right-5 bottom-5">
          <Button onClick={() => setOpenComment(!openComment)}>
            {openComment ? <X /> : <MessageCircle />}
          </Button>
          {openComment && <CommentBox />}
        </section>
      </div>
    </article>
  );
}

export default DocumentEditorSection;
