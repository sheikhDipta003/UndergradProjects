import { useEffect, useState } from "react";
import { Perks } from "../components/Perks";
import { PhotosUploader } from "../components/PhotosUploader";
import axios from "axios";
import { AccountNav } from "../components/AccountNav";
import { Navigate, useParams } from "react-router-dom";

export const PlacesFormPage = () => {
  const { id } = useParams();
  const [title, setTitle] = useState("");
  const [address, setAddress] = useState("");
  const [addedPhotos, setAddedPhotos] = useState([]);
  const [description, setDescription] = useState("");
  const [perks, setPerks] = useState([]);
  const [extraInfo, setExtraInfo] = useState("");
  const [checkIn, setCheckIn] = useState("");
  const [checkOut, setCheckOut] = useState("");
  const [maxGuests, setMaxGuests] = useState(1);
  const [redirect, setRedirect] = useState(false);
  const [price, setPrice] = useState(100);

  useEffect(() => {
    if (!id) {
      return;
    }
    axios.get("/places/" + id).then((response) => {
      const { data } = response;
      setTitle(data.title);
      setAddress(data.address);
      setAddedPhotos(data.photos);
      setDescription(data.description);
      setPerks(data.perks);
      setExtraInfo(data.extraInfo);
      setCheckIn(data.checkIn);
      setCheckOut(data.checkOut);
      setMaxGuests(data.maxGuests);
      setPrice(data.price);
    });
  }, []);

  const inputHeader = (text) => {
    return <h2 className="text-2xl mt-4">{text}</h2>;
  };

  const inputDescription = (text) => {
    return <p className="text-gray-500 text-sm">{text}</p>;
  };

  const preInput = (header, description) => {
    return (
      <>
        {inputHeader(header)}
        {inputDescription(description)}
      </>
    );
  };

  const savePlace = async (e) => {
    e.preventDefault();
    const placeData = {
      title,
      address,
      addedPhotos,
      description,
      perks,
      extraInfo,
      checkIn,
      checkOut,
      maxGuests,
      price
    };

    if (id) {
      // update
      await axios.put("/places", {
        id, ...placeData
      });
      setRedirect(true);
    } else {
      // new
      await axios.post("/places", placeData);
      setRedirect(true);
    }
  };

  if (redirect) {
    return <Navigate to={"/account/places"} />;
  }

  return (
    <article>
      <AccountNav />

      <form onSubmit={savePlace}>
        {preInput(
          "Title",
          "Title for your place, For example, The Riddle House, Skull Island"
        )}
        <input
          type="text"
          placeholder="title"
          value={title}
          onChange={(e) => setTitle(e.target.value)}
        />

        {preInput("Address", "Address to this place")}
        <input
          type="text"
          placeholder="address"
          value={address}
          onChange={(e) => setAddress(e.target.value)}
        />

        {preInput("Photos", "More = Better")}
        <PhotosUploader addedPhotos={addedPhotos} onChange={setAddedPhotos} />

        {preInput(
          "Description",
          "Describe your place, advertise its good points, also mention its limitations"
        )}
        <textarea
          value={description}
          onChange={(e) => setDescription(e.target.value)}
        />

        {preInput("Perks", "Select all the perks of your place")}
        <section className="grid mt-2 gap-2 grid-cols-2 md:grid-cols-3 lg:grid-cols-6">
          <Perks selected={perks} onChange={setPerks} />
        </section>

        {preInput("Extra Info", "House rules, etc")}
        <textarea
          value={extraInfo}
          onChange={(e) => setExtraInfo(e.target.value)}
        />

        {preInput(
          "Check In&Out Times",
          "Add check in and out times, remember to have some time window for cleaning the room between guests"
        )}
        <section className="grid gap-2 grid-cols-2 md:grid-cols-4">
          <section>
            <h3 className="mt-2 -mb-2">Check in time</h3>
            <input
              type="text"
              placeholder="14:00"
              value={checkIn}
              onChange={(e) => setCheckIn(e.target.value)}
            />
          </section>

          <section>
            <h3 className="mt-2 -mb-2">Check out time</h3>
            <input
              type="text"
              placeholder="14:00"
              value={checkOut}
              onChange={(e) => setCheckOut(e.target.value)}
            />
          </section>

          <section>
            <h3 className="mt-2 -mb-2">Max Number of Guests</h3>
            <input
              type="number"
              placeholder="1"
              value={maxGuests}
              onChange={(e) => setMaxGuests(e.target.value)}
            />
          </section>

          <section>
            <h3 className="mt-2 -mb-2">Price per Night</h3>
            <input
              type="number"
              placeholder="1"
              value={price}
              onChange={(e) => setPrice(e.target.value)}
            />
          </section>
        </section>

        <button className="primary my-4">Save</button>
      </form>
    </article>
  );
};
