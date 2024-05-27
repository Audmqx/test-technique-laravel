import './bootstrap';

import ReactDOM from 'react-dom/client';        

const App = (): JSX.Element => {
    return (
      <div>
        <h1>Gestion des candidats</h1>
      </div>
    );
  };


const rootElement = document.getElementById('app');

if (rootElement) {
    const root = ReactDOM.createRoot(rootElement);
    root.render(<App />);
}