import React from "react";
import SideNav from "../_components/SideNav";
import { Room } from "../../../Room";

// params.workspaceid : obtained via dynamic route
function Workspace({ params }) {
  return (
    <article>
      <Room params={params}>
        <SideNav params={params} />
      </Room>
    </article>
  );
}

export default Workspace;
