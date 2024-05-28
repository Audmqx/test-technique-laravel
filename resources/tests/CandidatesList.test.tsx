import React from 'react';
import { render, screen, waitFor } from '@testing-library/react';
import userEvent from '@testing-library/user-event'; // Importer userEvent
import axios from 'axios';
import CandidatesList from '../js/components/CandidatesList/CandidatesList';
import { QueryClient, QueryClientProvider } from '@tanstack/react-query';
import '@testing-library/jest-dom/extend-expect';
import { candidatesData } from './CandidatesData';

jest.mock('axios');
const mockedAxios = axios as jest.Mocked<typeof axios>;
const queryClient = new QueryClient();
const FIRST_ELEMENT = 0;

describe('CandidatesList', () => {
  test('renders candidates list', async () => {
    mockedAxios.get.mockResolvedValue({
      data: {
        data: candidatesData
      },
    });

    render(
      <QueryClientProvider client={queryClient}>
        <CandidatesList />
      </QueryClientProvider>
    );

    await waitFor(() => {
      expect(screen.getByText(/Margaret\s+Sauvage/)).toBeInTheDocument();
      expect(screen.getByText(/Frédérique\s+Le\s+roux/)).toBeInTheDocument();
      expect(screen.getByText(/Inès\s+Schneider/)).toBeInTheDocument();

      expect(screen.getByText(/Ouvrier\s+d'abattoir/)).toBeInTheDocument();
      expect(screen.getByText(/Sophrologue/)).toBeInTheDocument();
    });
  });

  test('shows message when no candidates found', async () => {
    mockedAxios.get.mockResolvedValue({
      data: {
        data: [],
      },
    });

    render(
      <QueryClientProvider client={queryClient}>
        <CandidatesList />
      </QueryClientProvider>
    );

    await waitFor(() => {
      expect(screen.getByText('Veuillez ajouter des candidats')).toBeInTheDocument();
    });
  });

  test('can delete a candidate', async () => {
       mockedAxios.get.mockResolvedValueOnce({
        data: {
          data: candidatesData
        },
      });

      mockedAxios.delete.mockResolvedValueOnce(undefined);
  
      render(
        <QueryClientProvider client={queryClient}>
          <CandidatesList />
        </QueryClientProvider>
      );
  
      const margaretElement = await screen.findByText(/Margaret\s+Sauvage/);
      expect(margaretElement).toBeInTheDocument();
  
      const deleteButtons = document.querySelectorAll('button[data-testid="delete-button"]');
      userEvent.click(deleteButtons[FIRST_ELEMENT]);
  
      await waitFor(() => {
        expect(screen.queryByText(/Margaret\s+Sauvage/)).not.toBeInTheDocument();
      });
  
      expect(mockedAxios.delete).toHaveBeenCalledWith('/api/candidates/1');
  });
});
