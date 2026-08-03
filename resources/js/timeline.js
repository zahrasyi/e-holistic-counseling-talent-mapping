import Alpine from 'alpinejs';

Alpine.data('timeline', () => ({
	steps: [
		{
			number: '01',
			title: 'Book Appointment',
			description: 'Scheduling an appointment with us is simple and confidential.',
		},
		{
			number: '02',
			title: 'Initial Consultation',
			description: 'A friendly session to understand your needs and goals.',
		},
		{
			number: '03',
			title: 'Progress Check-Ins',
			description: 'We track your journey and adjust the approach as needed.',
		},
		{
			number: '04',
			title: 'Ongoing Support',
			description: 'Continuous support to ensure long-term well-being.',
		},
	],
}));
