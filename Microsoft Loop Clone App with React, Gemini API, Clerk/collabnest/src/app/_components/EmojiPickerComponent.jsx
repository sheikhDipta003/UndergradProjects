import EmojiPicker from "emoji-picker-react";
import React, { useState } from "react";

function EmojiPickerComponent({ children, setEmojiIcon }) {
  const [openEmojiPicker, setOpenEmojiPicker] = useState(false);
  return (
    <article>
      <section onClick={() => setOpenEmojiPicker(true)}>{children}</section>
      {openEmojiPicker && (
        <section className="absolute z-10">
          <EmojiPicker
            emojiStyle="facebook"
            onEmojiClick={(e) => {
              setEmojiIcon(e.emoji);
              setOpenEmojiPicker(false);
            }}
          />
        </section>
      )}
    </article>
  );
}

export default EmojiPickerComponent;
