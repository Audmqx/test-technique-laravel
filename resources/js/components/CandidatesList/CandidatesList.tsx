import React, { useState } from 'react';
import { useQuery } from '@tanstack/react-query';
import axios from 'axios';
import CandidateItem from './CandidateItem';
import { Candidate } from './types';
import '../../../css/Candidates.css';

const fetchCandidates = async (endDate?: string): Promise<Candidate[]> => {
  const response = await axios.get('/api/candidates', { params: { end_date: endDate || undefined } });
  return response.data.data;
};

const CandidatesList = (): JSX.Element => {
  const [endDate, setEndDate] = useState('');
  const { data, error, isLoading, refetch } = useQuery<Candidate[]>(['candidates', endDate], () => fetchCandidates(endDate), {
    enabled: true,
  });

  const handleDateChange = (event: React.ChangeEvent<HTMLInputElement>) => {
    setEndDate(event.target.value);
  };

  const handleFilter = () => {
    refetch();
  };

  return (
    <div className="candidates-container">
      <h1>Liste des Candidats</h1>
      <div className="filter-section">
        <input
          type="date"
          value={endDate}
          onChange={handleDateChange}
          placeholder="Filter by end date"
        />
        <button onClick={handleFilter}>Filtrer</button>
      </div>
      {isLoading ? (
        <div>Chargement...</div>
      ) : error ? (
        <div>Une erreur est survenue</div>
      ) : !data || data.length === 0 ? (
        <div>Veuillez ajouter des candidats</div>
      ) : (
        <table className="candidates-table">
          <thead>
            <tr>
              <th>Prénom + Nom</th>
              <th>Intitulé et dates de la mission en cours</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            {data.map(candidate => (
              <CandidateItem key={candidate.id} candidate={candidate} />
            ))}
          </tbody>
        </table>
      )}
    </div>
  );
};

export default CandidatesList;
