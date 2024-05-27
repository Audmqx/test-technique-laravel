import React from 'react';
import { useQuery } from '@tanstack/react-query';
import axios from 'axios';
import CandidateItem from './CandidateItem';
import { Candidate } from './types';

const fetchCandidates = async (): Promise<Candidate[]> => {
    const response = await axios.get('/api/candidates');
    return response.data.data;
  };
  
  const CandidatesList = (): JSX.Element => {
    const { data, error, isLoading } = useQuery<Candidate[]>(['candidates'], fetchCandidates);
  
    if (isLoading) return <div>Chargement...</div>;
    if (error) return <div>Une erreur est survenue</div>;
    if (!data || data.length === 0) return <div>Veuillez ajouter des candidats</div>;
  
    return (
      <div>
        <h1>Candidates List</h1>
        <ul>
          {data.map(candidate => (
            <CandidateItem key={candidate.id} candidate={candidate} />
          ))}
        </ul>
      </div>
    );
  };
  
  export default CandidatesList;
