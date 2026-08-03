document.addEventListener('DOMContentLoaded', function() {
	const container = document.getElementById('education-container');
	const addButton = document.getElementById('add-education');

	let educationIndex = container.getElementsByClassName('education-entry').length;

	addButton.addEventListener('click', function() {
		const newEntry = document.createElement('div');
		newEntry.classList.add('education-entry', 'flex', 'items-center', 'space-x-2');

		newEntry.innerHTML = `
                <input type="text" name="education[${educationIndex}][gelar]" placeholder="Gelar (e.g., S.Psi.)"
                    class="block w-1/3 p-2.5 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">

                <input type="text" name="education[${educationIndex}][universitas]" placeholder="Nama Universitas"
                    class="block flex-1 p-2.5 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">

                <button type="button" class="remove-education p-2 text-red-500 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                </button>
            `;

		container.appendChild(newEntry);
		educationIndex++;
	});

	container.addEventListener('click', function(e) {
		if (e.target.closest('.remove-education')) {
			e.target.closest('.education-entry').remove();
		}
	});

	const photoInput = document.getElementById('profile_photo_input');
	const photoPreview = document.getElementById('photo-preview');

	if (photoInput) {
		photoInput.addEventListener('change', function(event) {
			const file = event.target.files[0];
			if (file) {
				const reader = new FileReader();
				reader.onload = function(e) {
					photoPreview.src = e.target.result;
				};
				reader.readAsDataURL(file);
			}
		});
	}
});
