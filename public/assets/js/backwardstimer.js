let lastclick = document.querySelector(".timer_js");

(function () {
  window.onload = function () { 
    lastclicki();
  };

  function lastclicki() {
    (async () => {
      try {
        const send = { clickTime: "1" };
        const init = {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
            Accept: "application/json",
          },
          body: JSON.stringify(send),
        };
        const response = await fetch("../app/php/lastclick.php", init);
        if (response.ok) {
          var responseData = await response.json();
          console.log(responseData.message);
          console.log(responseData.timer[0]);
        } else {
          throw new Error(response.statusText);
        }
      } catch (err) {
        console.error(err);
      }
    })();
  }
})();
