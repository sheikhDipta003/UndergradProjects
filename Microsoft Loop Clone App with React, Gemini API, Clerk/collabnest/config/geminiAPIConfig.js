/*
 * Install the Generative AI SDK
 *
 * $ npm install @google/generative-ai
 *
 * See the getting started guide for more information
 * https://ai.google.dev/gemini-api/docs/get-started/node
 */

const {
  GoogleGenerativeAI,
  HarmCategory,
  HarmBlockThreshold,
} = require("@google/generative-ai");

const apiKey = process.env.NEXT_PUBLIC_GEMINI_API_KEY;
const genAI = new GoogleGenerativeAI(apiKey);

const model = genAI.getGenerativeModel({
  model: "gemini-1.5-flash",
});

const generationConfig = {
  temperature: 1,
  topP: 0.95,
  topK: 64,
  maxOutputTokens: 8192,
  responseMimeType: "application/json",
};

  export const chatSession = model.startChat({
    generationConfig,
    // safetySettings: Adjust safety settings
    // See https://ai.google.dev/gemini-api/docs/safety-settings
    history: [
      {
        role: "user",
        parts: [
          {
            text: 'Reference to:\n{\n   "time": 1550476186479,\n   "blocks": [\n      {\n         "id": "oUq2g_tl8y",\n         "type": "header",\n         "data": {\n            "text": "Editor.js",\n            "level": 2\n         }\n      },\n      {\n         "id": "zbGZFPM-iI",\n         "type": "paragraph",\n         "data": {\n            "text": "Hey. Meet the new Editor. On this page you can see it in action — try to edit this text. Source code of the page contains the example of connection and configuration."\n         }\n      },\n      {\n         "id": "qYIGsjS5rt",\n         "type": "header",\n         "data": {\n            "text": "Key features",\n            "level": 3\n         }\n      },\n      {\n         "id": "XV87kJS_H1",\n         "type": "list",\n         "data": {\n            "style": "unordered",\n            "items": [\n               "It is a block-styled editor",\n               "It returns clean data output in JSON",\n               "Designed to be extendable and pluggable with a simple API"\n            ]\n         }\n      },\n      {\n         "id": "AOulAjL8XM",\n         "type": "header",\n         "data": {\n            "text": "What does it mean «block-styled editor»",\n            "level": 3\n         }\n      },\n      {\n         "id": "cyZjplMOZ0",\n         "type": "paragraph",\n         "data": {\n            "text": "Workspace in classic editors is made of a single contenteditable element, used to create different HTML markups. Editor.js <mark class=\\"cdx-marker\\">workspace consists of separate Blocks: paragraphs, headings, images, lists, quotes, etc</mark>. Each of them is an independent contenteditable element (or more complex structure) provided by Plugin and united by Editor\'s Core."\n         }\n      }\n   ],\n   "version": "2.8.1"\n}\n',
          },
        ],
      },
      {
        role: "model",
        parts: [
          {
            text: '```json\n{\n  "time": 1678878646573,\n  "blocks": [\n    {\n      "id": "X1e3p4s09T",\n      "type": "header",\n      "data": {\n        "text": "Grocery TODO List",\n        "level": 1\n      }\n    },\n    {\n      "id": "1D6t9N3f4J",\n      "type": "paragraph",\n      "data": {\n        "text": "This is your grocery shopping list. Add items and mark them as complete."\n      }\n    },\n    {\n      "id": "e7w4g46L3s",\n      "type": "list",\n      "data": {\n        "style": "unordered",\n        "items": [\n          "Milk",\n          "Eggs",\n          "Bread"\n        ]\n      }\n    }\n  ],\n  "version": "2.8.1"\n}\n```\n\n**Explanation:**\n\n* **`time`:** This field represents the timestamp when the data was created or last modified.\n* **`blocks`:** This array holds the content of the Editor.js, divided into blocks. \n    * **`id`:** Unique identifier for each block.\n    * **`type`:**  The type of block, e.g., "header", "paragraph", "list".\n    * **`data`:**  Data specific to the block type.\n        * **`text`:** The content of the block.\n        * **`level`:** For "header" blocks, the heading level (1 for H1, 2 for H2, etc.).\n        * **`style`:** For "list" blocks, specifies the list style (e.g., "unordered", "ordered").\n        * **`items`:** For "list" blocks, an array of list items.\n\n**How to use this JSON:**\n\n1. **Editor.js Integration:** This JSON data can be used as input to an Editor.js instance. When loaded, the editor will display the grocery list as defined in the JSON.\n2. **Data Manipulation:** You can easily modify the JSON to add, remove, or edit items in the list. For example, to add "Apples" to the list:\n   ```json\n   {\n      // ... existing JSON ...\n      "blocks": [\n         // ... existing blocks ...\n         {\n            "id": "e7w4g46L3s",\n            "type": "list",\n            "data": {\n               "style": "unordered",\n               "items": [\n                  "Milk",\n                  "Eggs",\n                  "Bread",\n                  "Apples" // New item\n               ]\n            }\n         }\n      ]\n   }\n   ```\n3. **Saving and Retrieving:** You can save the updated JSON data (representing the edited grocery list) to a database or file and later retrieve it to repopulate the Editor.js instance, preserving the user\'s edits. \n\nRemember that this is a basic template. You might need to extend it with additional block types (like checkboxes for marking items as complete) or data fields to suit your specific grocery list requirements. \n',
          },
        ],
      },
    ],
  });

//   const result = await chatSession.sendMessage("INSERT_INPUT_HERE");
//   console.log(result.response.text());
