import React, { useEffect, useRef, useState } from "react";
import EditorJS from "@editorjs/editorjs";
import Header from "@editorjs/header";
import Delimiter from "@editorjs/delimiter";
import Alert from "editorjs-alert";
import List from "@editorjs/list";
import SimpleImage from "@editorjs/simple-image";
import Table from "@editorjs/table";
import CodeTool from "@editorjs/code";
import Checklist from "@editorjs/checklist";
import { doc, onSnapshot, updateDoc } from "firebase/firestore";
import { db } from "../../../../../config/firebaseConfig";
import { useUser } from "@clerk/nextjs";
import GenerateAITemplate from './GenerateAITemplate';

function RichDocumentEditor({ params }) {
  const editorInstance = useRef(null);
  const { user } = useUser();
  const [documentOutput, setDocumentOutput] = useState([]);
  let isFetched = false;

  // save 'document' info in firestore, that is, whatever the user has typed in the document-editor
  const saveDocument = () => {
    editorInstance.current
      .save()
      .then(async (outputData) => {
        await updateDoc(doc(db, "documentOutput", params?.documentid), {
          output: JSON.stringify(outputData),
          editedBy: user?.primaryEmailAddress?.emailAddress,
        });
      })
      .catch((error) => {
        console.log("Saving failed: ", error);
      });
  };

  // fetch the previously saved document info from firestore, only if the data is not already fetched or the 'document' has been edited by a different user other than the initial editor
  const getDocumentOutput = () => {
    const unsubscribe = onSnapshot(
      doc(db, "documentOutput", params?.documentid),
      (doc) => {
        if (
          doc.data()?.editedBy !== user?.primaryEmailAddress?.emailAddress ||
          isFetched == false
        )
          doc.data()?.editedBy &&
            editorInstance.current?.render(JSON.parse(doc.data()?.output));
        isFetched = true;
      }
    );
  };

  useEffect(() => {
    if (user && !editorInstance.current) {
      editorInstance.current = new EditorJS({
        /**
         * id of Element that should contain the Editor
         */
        holder: "editorjs",
        tools: {
          header: Header,
          delimiter: Delimiter,
          alert: {
            class: Alert,
            inlineToolbar: true,
            shortcut: "CMD+SHIFT+A",
            config: {
              alertTypes: [
                "primary",
                "secondary",
                "info",
                "success",
                "warning",
                "danger",
                "light",
                "dark",
              ],
              defaultType: "primary",
              messagePlaceholder: "Enter something",
            },
            table: Table,
            list: {
              class: List,
              inlineToolbar: true,
              shortcut: "CMD+SHIFT+L",
              config: {
                defaultStyle: "unordered",
              },
            },
            checklist: {
              class: Checklist,
              shortcut: "CMD+SHIFT+C",
              inlineToolbar: true,
            },
            image: SimpleImage,
            code: {
              class: CodeTool,
              shortcut: "CMD+SHIFT+P",
            },
          },
        },
        onChange: (ap, event) => {
          saveDocument();
        },
        onReady: () => {
          getDocumentOutput();
        },
      });
    }

    return () => {
      if (editorInstance.current) {
        editorInstance.current.destroy();
        editorInstance.current = null;
      }
    };
  }, [user]);

  return (
    <section className="lg:-ml-60">
      <div id="editorjs"></div>
      <div className="fixed bottom-10 md:ml-80 left-0 z-10"><GenerateAITemplate setGenerateAIOutput={(output) => editorInstance.current?.render(output)}/></div>
    </section>
  );
}

export default RichDocumentEditor;
