
# Collabnest - An online collaborative workspace with AI support

Create, manage, collaborate on workspaces with collabnest. It has a rich document editor and Gemini text generation support along with a comment system for the documents and notification sytem.


## Features

- Create as many workspaces as you like by clicking on the plus (+) icon in [dashboard](http://localhost:3000/dashboard) page.
- Create at most 5 documents in a workspace
- Switch to another [organization](https://clerk.com/docs/organizations/overview) by clicking on the organiation name displayed at top of the [dashboard](http://localhost:3000/dashboard) page.
- Edit emoji, cover photo, title, content of the documents
- Hover the mouse over the left edge of the editor, you will see a plus (+) sign, click on it to insert *text/heading/delimitter/alert*
- Click on the button *Generative AI Template* at the bottom of the editor to give a prompt to Gemini and insert Gemini's response.
- Click on the comment icon at the bottom right of a document to insert a comment
- typing ```@``` will auto-suggest usernames for that workspace so that you can mention them
- Upon mentioning a user, notif is set to him/her which can be viewed from the top icon of the workspace page



## Tech Stack

**Full-stack framework:** [Next js](https://nextjs.org/docs/app/getting-started/installation)

**Third party libraries:**
- Clerk : [authentication](https://clerk.com/docs/quickstarts/nextjs)
- Editor js : [rich document editor](https://editorjs.io/getting-started/)
- liveblocks : [comment](https://liveblocks.io/docs/get-started/nextjs-comments) and [notification](https://liveblocks.io/docs/get-started/nextjs-notifications) system

**Gen AI**: [Gemini 1.5 Flash](https://aistudio.google.com/)


## Environment Variables

To run this project, you will need to add the following environment variables to your .env.local file

```NEXT_PUBLIC_CLERK_PUBLISHABLE_KEY```=""

```CLERK_SECRET_KEY```=""

```NEXT_PUBLIC_CLERK_SIGN_IN_URL```=/sign-in
```NEXT_PUBLIC_CLERK_SIGN_UP_URL```=/sign-up

```NEXT_PUBLIC_FIREBASE_API_KEY```=""

```NEXT_PUBLIC_MAX_FILE_COUNT```=5

```NEXT_PUBLIC_LIVEBLOCK_PK```=""

```LIVEBLOCK_SK```=""

```NEXT_PUBLIC_GEMINI_API_KEY```=""


## Run Locally

Clone the project
```bash
git clone https://github.com/sheikhDipta003/UndergradProjects.git
```

Go to the folder
```bash
cd "UndergradProjects/Microsoft Loop Clone App with React, Gemini API, Clerk/collabnest"
```

Instal all packages
```bash
npm install
```

Run the project
```bash
npm run dev 
```

## Demo

Insert gif or link to demo


## Acknowledgements
- [🔥 Create & Deploy a NextJs Full Stack Microsoft Loop 2.0 App with React, Gemini API, Clerk](https://youtu.be/6GKFEqB8LWo?si=8FQJyObSKqzSfTdQ)

