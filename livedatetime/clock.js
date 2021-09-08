const second = document.querySelector(".second");
const minute = document.querySelector(".minute");
const hour = document.querySelector(".hour");

const setClock = () => {
  const currentDate = new Date();
  const seconds = currentDate.getSeconds() / 60;
  const minutes = (seconds + currentDate.getMinutes()) / 60;
  const hours = (minutes + currentDate.getHours()) / 12;

  rotateClock(second, seconds);
  rotateClock(minute, minutes);
  rotateClock(hour, hours);
};

const rotateClock = (element, ratio) => {
  element.style.setProperty("--rotate", `${ratio * 360}deg`);
};

setClock();
setInterval(setClock, 1000);
