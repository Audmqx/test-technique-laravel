import React from 'react';
import ReactDOM from 'react-dom/client';
import { QueryClient, QueryClientProvider } from '@tanstack/react-query';
import CandidatesList from './components/CandidatesList/CandidatesList';

const queryClient = new QueryClient();

const App = (): JSX.Element => {
  return (
      <QueryClientProvider client={queryClient}>
          <CandidatesList />
      </QueryClientProvider>
  );
};

const root = ReactDOM.createRoot(document.getElementById('app')!);
root.render(<App />);