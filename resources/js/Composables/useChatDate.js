export default function useChatDate() {
  const timeDisplay = (date) => {
    const now = new Date();
    const past = new Date(date);
    const diffInSeconds = Math.floor((now - past) / 1000); // Difference in seconds

    if (diffInSeconds < 86400) {
      const hour = past.getHours();
      const minutes = past.getMinutes();
      // Less than a minute
      return `${hour}:${minutes}`;
    }

    const diffInMinutes = Math.floor(diffInSeconds / 60);
    const diffInHours = Math.floor(diffInMinutes / 60);
    const diffInDays = Math.floor(diffInHours / 24);
    if (diffInDays < 7) {
      // Less than a week
      return `${diffInDays}d`;
    }

    // Otherwise, return the date in 'y-m-d' format
    const year = past.getFullYear();
    const month = String(past.getMonth() + 1).padStart(2, "0"); // Months are 0-indexed
    const day = String(past.getDate()).padStart(2, "0");

    return `${year}-${month}-${day}`;
  };

  return {
    timeDisplay,
  };
}
