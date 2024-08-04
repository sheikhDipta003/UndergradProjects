"use client";
import React from "react";
import SideNav from "../../_components/SideNav";
import DocumentEditorSection from "../../_components/DocumentEditorSection";
import { Room } from "@/app/Room";

// params.workspaceid, params.documentid : obtained via dynamic route
function WorkspaceDocument({ params }) {
  return (
    <Room params={params}>
      <article>
        {/* Side Nav */}
        <section className="">
          <SideNav params={params} />
        </section>

        {/* Document */}
        <section className="md:ml-72">
          <DocumentEditorSection params={params} />
        </section>
      </article>
    </Room>
  );
}

export default WorkspaceDocument;
