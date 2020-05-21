<link href="css/search-bar.css" rel="stylesheet" />
    <div class="s002">
      <form action="./search.php" method="POST">
        <fieldset>
          <legend>SEARCH HOTEL</legend>
        </fieldset>
        <div class="inner-form">
          <div class="input-field first-wrap">
            <div class="icon-wrap">
             
            </div>
            <input id="search" type="text" placeholder="Search Hotle" />
          </div>
          <div class="input-field second-wrap">
            <div class="icon-wrap">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                <path d="M17 12h-5v5h5v-5zM16 1v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2h-1V1h-2zm3 18H5V8h14v11z"></path>
              </svg>
            </div>
            <input class="datepicker" id="depart" type="text" placeholder="FROM" />
          </div>
          <div class="input-field third-wrap">
            <div class="icon-wrap">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                <path d="M17 12h-5v5h5v-5zM16 1v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2h-1V1h-2zm3 18H5V8h14v11z"></path>
              </svg>
            </div>
            <input class="datepicker" id="return" type="text" placeholder="To" />
          </div>
          <div class="input-field fouth-wrap">
            <div class="icon-wrap">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"></path>
              </svg>
            </div>
            
            <select data-trigger="" name="choices-single-defaul">

            <option>Location</option>
              <option value="NY">New York</option>
              <option value="MC">Manchester</option>
              <option value="LV">Las Vegas</option>

           
            </select>
          </div>
          <div class="input-field fifth-wrap">
            <button class="btn-search" type="submit">SEARCH</button>
          </div>
        </div>
      </form>
    </div>
    <script src="scripts/js/extensions/choices.js"></script>
    <script src="scripts/js/extensions/flatpickr.js"></script>
    <script>
      flatpickr(".datepicker",
      {});

    </script>
    <script>
      const choices = new Choices('[data-trigger]',
      {
        searchEnabled: false,
        itemSelectText: '',
      });

    </script>
  