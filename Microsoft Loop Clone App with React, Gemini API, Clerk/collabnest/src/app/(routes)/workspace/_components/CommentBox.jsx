"use client"
import React from 'react'
import { useThreads } from "@liveblocks/react/suspense";
import { Composer, Thread } from "@liveblocks/react-ui";

function CommentBox() {
    const { threads } = useThreads();

    return (
      <article className='w-[300px] h-[350px] shadow-lg rounded-lg overflow-auto'>
        {threads?.map((thread) => (
          <Thread key={thread.id} thread={thread} />
        ))}
        <Composer />
      </article>
    );
}

export default CommentBox
