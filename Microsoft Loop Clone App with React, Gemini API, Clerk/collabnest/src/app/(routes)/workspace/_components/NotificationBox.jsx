"use client";

import React, { useEffect } from "react";
import {
  Popover,
  PopoverContent,
  PopoverTrigger,
} from "../../../../components/ui/popover";
import { useInboxNotifications, useUnreadInboxNotificationsCount, useUpdateRoomNotificationSettings } from "@liveblocks/react/suspense";
import { InboxNotification, InboxNotificationList } from "@liveblocks/react-ui";

function NotificationBox({ children }) {
  const { inboxNotifications } = useInboxNotifications();
  const updateRoomNotificationSettings = useUpdateRoomNotificationSettings();
  const {count} = useUnreadInboxNotificationsCount();

    useEffect(() => {
        updateRoomNotificationSettings({threads: 'all'});
    }, [count]);

  return (
    <Popover>
      <PopoverTrigger>
        <div className="flex">
        {children}
        <span className="p-1 px-2 -ml-0 rounded-full bg-primary text-[8px] text-white">{count}</span>
        </div>
    </PopoverTrigger>
      <PopoverContent className="w-[500px]">
        <InboxNotificationList>
          {inboxNotifications.map((inboxNotification) => (
            <InboxNotification
              key={inboxNotification.id}
              inboxNotification={inboxNotification}
            />
          ))}
        </InboxNotificationList>
      </PopoverContent>
    </Popover>
  );
}

export default NotificationBox;
