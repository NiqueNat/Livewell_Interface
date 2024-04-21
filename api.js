document.addEventListener('DOMContentLoaded', function () {

    // Function to fetch and display recipes from the API
    async function searchRecipes(searchQuery) {
      console.log('Search query:', searchQuery);
  
      const apiUrl = `https://recipe-by-api-ninjas.p.rapidapi.com/v1/recipe?query=${encodeURIComponent(searchQuery)}`;
      const options = {
        method: 'GET', // Change the method to GET
        headers: {
          'X-RapidAPI-Key': '602b1d10e7msh729009cde5e2c12p1e2d1fjsnf6f210c8ff9d',
          'X-RapidAPI-Host': 'recipe-by-api-ninjas.p.rapidapi.com',
        },
      };
  
      try {
        const response = await fetch(apiUrl, options);
        const data = await response.json();
  
        console.log('API response:', data);
  
        // Check the structure of the API response and adjust accordingly
        const apiRecipes = Array.isArray(data) ? data : data.results; // Update this based on the actual response structure
  
        // Display the API-sourced recipes in a list
        displaySearchResults(apiRecipes);
      } catch (error) {
        console.error(error);
      }
    }
  
    // Function to display search results
    function displaySearchResults(apiRecipes) {
      // Get a reference to the container where you want to display the results
      const searchResultsContainer = document.getElementById('search-results');
  
      // Clear previous search results
      searchResultsContainer.innerHTML = '';
  
      // Iterate through the API-sourced recipes and display them
      apiRecipes.forEach((recipe, index) => {
        const recipeItem = document.createElement('div');
        recipeItem.className = 'recipe-item';
  
        const recipeTitle = document.createElement('h2');
        recipeTitle.textContent = recipe.title;
  
        recipeItem.appendChild(recipeTitle);
  
        // Add a button to save the recipe
        const saveButton = document.createElement('button');
        saveButton.textContent = 'Save';
        saveButton.addEventListener('click', () => {
          // Send a request to your PHP backend to save the selected recipe
          saveRecipe(recipe);
        });
  
        recipeItem.appendChild(saveButton);
  
        // Append the recipe item to the search results container
        searchResultsContainer.appendChild(recipeItem);
      });
    }
  
    // Function to save a recipe to the database
    async function saveRecipe(recipe) {
        const saveUrl = 'save_recipe.php'; // Replace with the actual path to the save_recipe.php file on your server
        const options = {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify({ selectedRecipe: recipe }), // Wrap the recipe in an object with key 'selectedRecipe'
        };
      
        // Debugging statement to print out the contents of recipe
        console.log('Recipe:', recipe);
      
        try {
          const response = await fetch(saveUrl, options);
          //   const data = await response.json();
      
          //   console.log('Save response:', data);
        } catch (error) {
          console.error(error);
        }
    }
  
    // Get the search form element
    const searchForm = document.getElementById('search-form');
  
    // Add an event listener to the search form
    searchForm.addEventListener('submit', (event) => {
      // Prevent the default form submission behavior
      event.preventDefault();
  
      // Get the search query from the form input
      const searchQuery = document.getElementById('searchQuery').value;
  
      // Call the searchRecipes function with the search query
      searchRecipes(searchQuery);
    });
  
});
// Function to fetch and display API-sourced recipes
async function fetchApiRecipes(searchQuery) {
    const apiUrl = `https://recipe-by-api-ninjas.p.rapidapi.com/v1/recipe?query=${encodeURIComponent(searchQuery)}`;
    const options = {
        method: 'GET',
        headers: {
            'X-RapidAPI-Key': '602b1d10e7msh729009cde5e2c12p1e2d1fjsnf6f210c8ff9d',
            'X-RapidAPI-Host': 'recipe-by-api-ninjas.p.rapidapi.com',
        },
    };

    try {
        const response = await fetch(apiUrl, options);
        const data = await response.json();

        console.log('API response:', data);

        // Check the structure of the API response and adjust accordingly
        const apiRecipes = Array.isArray(data) ? data : data.results; // Update this based on the actual response structure

        // Display the API-sourced recipes in a list or table
        displayApiRecipes(apiRecipes);
    } catch (error) {
        console.error(error);
    }
}

// Function to display API-sourced recipes
function displayApiRecipes(apiRecipes) {
    // Get a reference to the container where you want to display the results
    const searchResultsContainer = document.getElementById('search-results');

    // Clear previous search results
    searchResultsContainer.innerHTML = '';

    // Iterate through the API-sourced recipes and display them
    apiRecipes.forEach((recipe, index) => {
        const recipeItem = document.createElement('div');
        recipeItem.className = 'recipe-item';

        const recipeTitle = document.createElement('h2');
        recipeTitle.textContent = recipe.title;

        const recipeDescription = document.createElement('p');
        recipeDescription.textContent = recipe.description;

        const recipeIngredients = document.createElement('p');
        recipeDescription.textContent = recipe.ingredients;

        const recipeInstruction = document.createElement('p');
        recipeDescription.textContent = recipe.instructions;

        // You can add more elements to display additional information as needed

        recipeItem.appendChild(recipeTitle);
        recipeItem.appendChild(recipeDescription);
        recipeItem.appendChild(recipeIngredients);
        recipeItem.appendChild(recipeInstruction);

        // Add a button to save the recipe
        const saveButton = document.createElement('button');
        saveButton.textContent = 'Save';
        saveButton.addEventListener('click', () => {
            // Send a request to your PHP backend to save the selected recipe
            saveRecipe(recipe);
        });

        recipeItem.appendChild(saveButton);

        // Append the recipe item to the search results container
        searchResultsContainer.appendChild(recipeItem);
    });
}

// You can call the fetchApiRecipes function with a search query
fetchApiRecipes('YourSearchQueryHere');
