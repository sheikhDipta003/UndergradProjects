import React, { useState } from "react";
import { Button } from "../../../../components/ui/button";
import { LayoutGrid, Loader2Icon } from "lucide-react";
import {
  Dialog,
  DialogContent,
  DialogDescription,
  DialogHeader,
  DialogTitle,
  DialogTrigger,
} from "../../../../components/ui/dialog";
import { Input } from "../../../../components/ui/input";
import { chatSession } from "../../../../../config/geminiAPIConfig";

function GenerateAITemplate({ setGenerateAIOutput }) {
  const [open, setOpen] = useState(false);
  const [userInput, setUserInput] = useState();
  const [loading, setLoading] = useState(false);

  const generateFromAI = async () => {
    setLoading(true);
    const prompt = "Generate template for editor.js in JSON for " + userInput;
    const result = await chatSession.sendMessage(prompt);
    try {
        const output = JSON.parse(result.response.text());
        setGenerateAIOutput(output);
    } catch (err) {
        setLoading(false);
    }
    setLoading(false);
    setOpen(false);
  };

  return (
    <div>
      <Button
        variant="outline"
        className="flex gap-2"
        onClick={() => setOpen(true)}
      >
        <LayoutGrid className="h-4 w-4" /> Generate AI Template
      </Button>

      <Dialog open={open}>
        <DialogContent>
          <DialogHeader>
            <DialogTitle>Generate AI Template</DialogTitle>
            <DialogDescription>
              <h2 className="mt-5">
                What do you want to write in the document?
              </h2>
              <Input placeholder="For example, project idea" onChange={(e) => setUserInput(e?.target.value)}/>
              <div className="mt-5 flex gap-5 justify-end">
                <Button variant="ghost" onClick={() => setOpen(false)}>
                  Cancel
                </Button>
                <Button
                  onClick={() => generateFromAI()}
                  disabled={!userInput || loading}
                >
                  {loading ? (
                    <Loader2Icon className="animate-spin" />
                  ) : (
                    "Generate"
                  )}
                </Button>
              </div>
            </DialogDescription>
          </DialogHeader>
        </DialogContent>
      </Dialog>
    </div>
  );
}

export default GenerateAITemplate;
