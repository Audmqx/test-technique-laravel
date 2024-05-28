export interface Mission {
  id: number;
  candidate_id: number;
  title: string;
  start_date: string;
  end_date: string;
  created_at: string;
  updated_at: string;
}

export interface Candidate {
  id: number;
  name: string;
  surname: string;
  current_mission: Mission | string;
  total_missions: number;
}
