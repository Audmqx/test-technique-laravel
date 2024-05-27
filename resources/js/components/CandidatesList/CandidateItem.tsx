import React from 'react';
import { Candidate } from './types';

interface CandidateItemProps {
  candidate: Candidate;
}

const CandidateItem = ({ candidate }: CandidateItemProps): JSX.Element => {
  const missionTitle = typeof candidate.current_mission === 'string' ? candidate.current_mission : candidate.current_mission.title;

  return (
    <li>
      {candidate.name} {candidate.surname} - Mission en cours: {missionTitle} - Missions cumulés: {candidate.total_missions}
    </li>
  );
};

export default CandidateItem;
