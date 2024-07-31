import { useContext, useState } from "react";
import { UserContext } from "../UserContext";
import { Navigate, useParams } from "react-router-dom";
import axios from "axios";
import { PlacesPage } from "./PlacesPage";
import { AccountNav } from "../components/AccountNav";

export const ProfilePage = () => {
  const { ready, user, setUser } = useContext(UserContext);
  const [redirect, setRedirect] = useState(null);
  let { subpage } = useParams();
  if (subpage === undefined) {
    subpage = "profile";
  }

  const logout = async () => {
    await axios.post("/logout");
    setRedirect("/");
    setUser(null);
  };

  if (!ready) {
    return "Loading...";
  }

  if (ready && !user && !redirect) {
    return <Navigate to={"/login"} />;
  }

  if (redirect) {
    return <Navigate to={redirect} />;
  }

  return (
    <article>
      <AccountNav />

      {subpage === "profile" && (
        <section className="text-center max-w-lg mx-auto">
          Logged in as {user.name} ({user.email}) <br />
          <button className="primary max-w-md mt-2" onClick={logout}>
            Logout
          </button>
        </section>
      )}

      {subpage === "places" && <PlacesPage />}
    </article>
  );
};
