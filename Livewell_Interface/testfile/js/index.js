document.addEventListener('DOMContentLoaded', function () {
    // Function to toggle between login and registration forms
    function toggleForms() {
        const loginForm = document.getElementById('login-form');
        const registerForm = document.getElementById('register-form');
        const loginButton = document.getElementById('login-button');
        const registerButton = document.getElementById('register-button');

        loginButton.addEventListener('click', function () {
            loginForm.style.display = 'block';
            registerForm.style.display = 'none';
        });

        registerButton.addEventListener('click', function () {
            loginForm.style.display = 'none';
            registerForm.style.display = 'block';
        });
    }

    toggleForms(); // Call the function to initialize form toggling

    // Example of a function to send a POST request to add a recipe
    function addRecipe(title, description, ingredients, instructions) {
        const recipeData = {
            title: title,
            description: description,
            ingredients: ingredients,
            instructions: instructions,
            userID: userID, // Add the userID value to the recipeData object
        };
    
        fetch('add_recipe.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(recipeData),
        })
            .then(response => {
                if (response.ok) {
                    // Recipe added successfully, you can redirect the user to the recipe list or show a success message
                    window.location.href = 'index.php';
                } else {
                    // Handle errors here, e.g., display an error message to the user
                    console.error('Failed to add recipe');
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }

    // Function to handle editing a recipe
    function editRecipe(recipeId, title, description) {
        const recipeData = {
            id: recipeId,
            title: title,
            description: description,
        };

        fetch('edit_recipe.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(recipeData),
        })
            .then(response => {
                if (response.ok) {
                    // Recipe edited successfully, you can redirect the user to the updated recipe or show a success message
                    window.location.href = 'index.php';
                } else {
                    // Handle errors here, e.g., display an error message to the user
                    console.error('Failed to edit recipe');
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }

    // Function to handle deleting a recipe
    function deleteRecipe(recipeId) {
        const recipeData = {
            id: recipeId,
        };

        fetch('delete_recipe.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(recipeData),
        })
            .then(response => {
                if (response.ok) {
                    // Recipe deleted successfully, you can redirect the user to the recipe list or show a success message
                    window.location.href = 'index.php';
                } else {
                    // Handle errors here, e.g., display an error message to the user
                    console.error('Failed to delete recipe');
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }

    // Event listener for the "Add Recipe" form submission on add_recipe.php
    const addRecipeForm = document.querySelector('#add-recipe-form');
    if (addRecipeForm) {
        addRecipeForm.addEventListener('submit', function (e) {
            e.preventDefault();
            const title = document.querySelector('#title').value;
            const description = document.querySelector('#description').value;
            addRecipe(title, description);
        });
    }

    // Event listener for the "Edit Recipe" form submission on edit_recipe.php
    const editRecipeForm = document.querySelector('#edit-recipe-form');
    if (editRecipeForm) {
        editRecipeForm.addEventListener('submit', function (e) {
            e.preventDefault();
            const recipeId = '' /* Get the recipe ID */;
            const title = '' /* Get the updated title */;
            const description = '' /* Get the updated description */;
            editRecipe(recipeId, title, description);
        });
    }

    // Event listener for the "Delete Recipe" button on delete_recipe.php
    const deleteRecipeButton = document.querySelector('#delete-recipe-button');
    if (deleteRecipeButton) {
        deleteRecipeButton.addEventListener('click', function () {
            const recipeId = '' /* Get the recipe ID */;
            deleteRecipe(recipeId);
        });
    }

    // Event listener for the login form submission
    const loginForm = document.querySelector('#login-form');
    if (loginForm) {
        loginForm.addEventListener('submit', function (e) {
            e.preventDefault();
            const email = document.querySelector('#login-email').value;
            const password = document.querySelector('#login-password').value;
            loginUser(email, password);
        });
    }

    // Event listener for the registration form submission
    const registerForm = document.querySelector('#register-form');
    if (registerForm) {
        registerForm.addEventListener('submit', function (e) {
            e.preventDefault();
            const email = document.querySelector('#register-email').value;
            const password = document.querySelector('#register-password').value;
            registerUser(email, password);
        });
    }
});
