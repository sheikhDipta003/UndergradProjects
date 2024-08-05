import React, { useState } from "react";
import {
  Dialog,
  DialogContent,
  DialogDescription,
  DialogHeader,
  DialogTitle,
  DialogTrigger,
  DialogFooter,
  DialogClose,
} from "../../components/ui/dialog";
import { Button } from "../../components/ui/button";
import CoverOption from "../_shared/CoverOption";
import Image from "next/image";

function CoverPicker({ children, setNewCover }) {
  const [selectedCover, setSelectedCover] = useState();

  return (
    <Dialog>
      <DialogTrigger className="w-full">{children}</DialogTrigger>
      <DialogContent>
        <DialogHeader>
          <DialogTitle>Update Cover</DialogTitle>
          <DialogDescription>
            <div className="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5 mt-3">
              {CoverOption.map((cover, index) => (
                <div
                  onClick={() => setSelectedCover(cover?.imageUrl)}
                  className={`${
                    selectedCover === cover?.imageUrl &&
                    "border-primary border-2"
                  } p-1 rounded-md cursor-pointer`}
                  key={index}
                >
                  <Image
                    src={cover?.imageUrl}
                    width={200}
                    height={140}
                    className="h-[70px] w-full rounded-md object-cover"
                    alt="cover-choice"
                  />
                </div>
              ))}
            </div>
          </DialogDescription>
        </DialogHeader>
        <DialogFooter className="">
          <DialogClose asChild>
            <Button type="button" variant="secondary">
              Close
            </Button>
          </DialogClose>
          <DialogClose asChild>
            <Button type="button" onClick={() => setNewCover(selectedCover)}>
              Update
            </Button>
          </DialogClose>
        </DialogFooter>
      </DialogContent>
    </Dialog>
  );
}

export default CoverPicker;
