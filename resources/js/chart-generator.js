const { Chart } = require('chart.js');
const canvas = require('chartjs-node-canvas');

// Replace with your data and chart configuration
const data = {
  labels: ['Category 1', 'Category 2', 'Category 3'],
  datasets: [{
    label: 'My Data',
    data: [10, 20, 30],
    backgroundColor: ['#f44336', '#9b59b6', '#2ecc71']
  }]
};

const options = {
  // Your chart options (e.g., type: 'bar')
};

(async () => {
  const configuration = {
    type: 'pie', // Replace with your chart type
    data,
    options
  };

  const image = await canvas.render(configuration);
  const base64Image = image.toString('base64');

  // Use the base64Image for further processing or return it
  console.log(base64Image);
})();
