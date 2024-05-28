import React from 'react';
import { useMutation, useQueryClient } from '@tanstack/react-query';
import axios from 'axios';
import { Candidate } from './types';

interface CandidateItemProps {
  candidate: Candidate;
}

const CandidateItem = ({ candidate }: CandidateItemProps): JSX.Element => {
  const queryClient = useQueryClient();

  const deleteCandidate = async (id: number) => {
    await axios.delete(`/api/candidates/${id}`);
  };

  const mutation = useMutation(deleteCandidate, {
    onSuccess: () => {
      queryClient.invalidateQueries(['candidates']);
    },
  });

  const handleDelete = () => {
    mutation.mutate(candidate.id);
  };

  const missionTitle = typeof candidate.current_mission === 'string' ? candidate.current_mission : candidate.current_mission.title;

  return (
    <li>
      {candidate.name} {candidate.surname} - Mission en cours: {missionTitle} - Missions cumulés: {candidate.total_missions} 
      <button data-testid="delete-button" onClick={handleDelete}>Supprimer</button> 
    </li>
  );
};

export default CandidateItem;
