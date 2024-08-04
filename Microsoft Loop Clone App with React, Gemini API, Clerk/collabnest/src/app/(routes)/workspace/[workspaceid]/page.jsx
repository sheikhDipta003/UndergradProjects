import React from "react";
import SideNav from "../_components/SideNav";

// params.workspaceid : obtained via dynamic route
function Workspace({ params }) {
  return (
    <article>
      <SideNav params={params} />
    </article>
  );
}

export default Workspace;
