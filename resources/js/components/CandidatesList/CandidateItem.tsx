import React from 'react';
import { useMutation, useQueryClient } from '@tanstack/react-query';
import axios from 'axios';
import { Candidate } from './types';

interface CandidateItemProps {
  candidate: Candidate;
}

const CandidateItem: React.FC<CandidateItemProps> = ({ candidate }): JSX.Element => {
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

  const currentMission = typeof candidate.current_mission === 'string' ? candidate.current_mission : `${candidate.current_mission.title} (${candidate.current_mission.start_date} - ${candidate.current_mission.end_date})`;

  return (
    <tr>
      <td>{candidate.name} {candidate.surname}</td>
      <td>{currentMission}</td>
      <td>
        <button data-testid="delete-button" onClick={handleDelete}>Supprimer</button>
      </td>
    </tr>
  );
};

export default CandidateItem;
