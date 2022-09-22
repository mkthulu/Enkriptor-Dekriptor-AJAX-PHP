<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>20330047 | Enkriptor-Dekriptor</title>
    <link rel="stylesheet" href="styles.css" />
  </head>
  <body>
    <div class="container" id="encryptor-decryptor">
      <h1 class="title">Enkriptor-Dekriptor</h1>
      <p class="description">
        Ubah teks asli menjadi teks terenkripsi.
      </p>
      <div class="folder">
        <fieldset>
          <legend>Pilih mode:</legend>
          <label for="spread-encrypt">
            <input
              type="radio"
              class="spreader"
              name="spreader"
              id="spread-encrypt"
              data-target="#encrypt"
              checked
            />
            Enkripsi
          </label>
          <label for="spread-decrypt">
            <input
              type="radio"
              class="spreader"
              name="spreader"
              id="spread-decrypt"
              data-target="#decrypt"
            />
            Dekripsi
          </label>
        </fieldset>
        <form
          class="form fold"
          id="encrypt"
          data-type="encrypt"
          data-target-value='#plaintext'
          data-target-result='#encrypt-result'
          onsubmit="return false;"
        >
          <label for="plaintext">
            <i>Plaintext</i>:
            <input
              type="text"
              name="plaintext"
              id="plaintext"
              placeholder="Masukkan teks asli"
              required
            />
          </label>
          <input type="submit" value="Mulai Enkripsi"/>
          <label for="encrypt-result">
            Hasil enkripsi:
            <textarea
              name="encrypt-result"
              id="encrypt-result"
              placeholder="-"
              readonly
            ></textarea>
          </label>
        </form>
        <form
          class="form fold"
          id="decrypt"
          data-type="decrypt"
          data-target-value='#cyphertext'
          data-target-result='#decrypt-result'
          onsubmit="return false;"
        >
          <label for="cyphertext">
            <i>Cyphertext</i>:
            <textarea
              name="cyphertext"
              id="cyphertext"
              placeholder="Masukkan teks terenkripsi"
              required
            ></textarea>
          </label>
          <input type="submit" value="Mulai Dekripsi"/>
          <label for="decrypt-result">
            Hasil dekripsi:
            <textarea
              name="decrypt-result"
              id="decrypt-result"
              placeholder="-"
              readonly
            ></textarea>
          </label>
        </form>
      </div>
    </div>

    <script>
      const spreaderEls = document.querySelectorAll(".spreader");
      const foldEls = document.querySelectorAll(".fold");
      const formEls = document.querySelectorAll(".form");

      foldEls.forEach((el) => {
        el.style.display = "none";
      });
      
      spreaderEls.forEach((el) => {
        if (el.checked)
          document.querySelector(el.dataset.target).style.display = "block";
        el.addEventListener("click", (ev) => {
          let target = document.querySelector(ev.target.dataset.target);
          foldEls.forEach((el) => {
            if (el === target) el.style.display = "block";
            else el.style.display = "none";
          });
        });
      });

      formEls.forEach((el) => {
        el.addEventListener('submit', (ev) => {
          let value = document
            .querySelector(ev.target.dataset.targetValue)
            .value;
          if (value.length != 0) {
            if (!(
              ev.target.dataset.type === 'encrypt' ||
              ev.target.dataset.type === 'decrypt'
              )) return;

            let xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
              if (this.readyState == 4 && this.status == 200) {
                document.querySelector(ev.target.dataset.targetResult)
                  .value = this.responseText;
              }
            };

            if (ev.target.dataset.type === 'encrypt')
              xmlhttp.open("GET", "encrypt.php?q=" + value, true);
            else xmlhttp.open("GET", "decrypt.php?q=" + value, true);

            xmlhttp.send();
          }
          ev.preventDefault();
        })
      })
    </script>
  </body>
</html>
