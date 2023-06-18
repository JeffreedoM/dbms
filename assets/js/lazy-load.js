// Global variables
let page = 1;
const cardsPerPage = 12;
let isLoading = false;

// Get the card container element
const cardContainer = document.querySelector(".card-container");

// Load the card template
fetch("assets/js/card-template.handlebars")
  .then((response) => response.text())
  .then((templateSource) => {
    // Compile the Handlebars template
    const template = Handlebars.compile(templateSource);

    // Function to create a card element
    const createCardElement = (building) => {
      const context = {
        imageUrl: building.bldg_image
          ? `admin/assets/images/uploads/${building.bldg_image}`
          : "admin/assets/images/uploads/bldg_default.jpg",
        buildingName: building.building_name,
        location: building.location,
        building_id: building.building_id,
      };
      const html = template(context);
      const cardElement = document.createElement("div");
      cardElement.innerHTML = html;
      return cardElement.firstChild;
    };

    // Function to fetch cards from the API
    const fetchCards = () => {
      if (!fetchMore) {
        return; // Stop fetching if fetchMore flag is false
      }

      isLoading = true;

      fetch(`includes/cards.php?page=${page}&limit=${cardsPerPage}`)
        .then((response) => response.json())
        .then((data) => {
          const buildings = data.buildings;

          // Create card elements and append them to the container
          buildings.forEach((building) => {
            const cardElement = createCardElement(building);
            cardContainer.appendChild(cardElement);
          });

          page++;
          isLoading = false;
        })
        .catch((error) => {
          console.error("Error fetching cards:", error);
          isLoading = false;
        });
    };

    // Function to check if scrolling near the bottom of the page
    const checkScroll = () => {
      const scrollTop =
        document.documentElement.scrollTop || document.body.scrollTop;
      const windowHeight = window.innerHeight;
      const documentHeight = document.documentElement.offsetHeight;

      if (scrollTop + windowHeight >= documentHeight - 100 && !isLoading) {
        fetchCards();
      }
    };

    // Event listener for scroll
    window.addEventListener("scroll", checkScroll);

    // Initial fetch
    fetchCards();
  })
  .catch((error) => {
    console.error("Error loading card template:", error);
  });
