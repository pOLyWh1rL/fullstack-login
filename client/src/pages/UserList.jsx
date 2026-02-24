import { useEffect, useState } from 'react';
import { useNavigate, Link } from 'react-router-dom';

export default function UserList() {
  const [users, setUsers] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState('');
  const navigate = useNavigate();

  // 1. Protect the route and fetch data when the component mounts
  useEffect(() => {
    // Check authentication first
    const loggedInUser = localStorage.getItem('user');
    if (!loggedInUser) {
      navigate('/login');
      return; // Stop execution if not logged in
    }

    // 2. Fetch the user data from the PHP API
    const fetchUsers = async () => {
      try {
        const response = await fetch('http://localhost/fullstack-login/api/get_users.php');
        const result = await response.json();

        if (result.status === 'success') {
          setUsers(result.data);
        } else {
          setError(result.message || 'Failed to fetch users.');
        }
      } catch (err) {
        setError('Error connecting to the server. Is XAMPP running?');
      } finally {
        setLoading(false); // Stop the loading spinner
      }
    };

    fetchUsers();
  }, [navigate]);

  return (
    <div className="container mt-5">
      <div className="card shadow">
        <div className="card-header bg-primary text-white d-flex justify-content-between align-items-center">
          <h3 className="mb-0">Registered Users</h3>
          <Link to="/dashboard" className="btn btn-light btn-sm">Back to Dashboard</Link>
        </div>
        
        <div className="card-body">
          {/* Display loading state, errors, or the table */}
          {loading ? (
            <div className="text-center p-4">
              <div className="spinner-border text-primary" role="status">
                <span className="visually-hidden">Loading...</span>
              </div>
            </div>
          ) : error ? (
            <div className="alert alert-danger">{error}</div>
          ) : users.length === 0 ? (
            <div className="alert alert-info">No users found in the database.</div>
          ) : (
            <div className="table-responsive">
              <table className="table table-hover table-bordered">
                <thead className="table-light">
                  <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Date Registered</th>
                  </tr>
                </thead>
                <tbody>
                  {/* Loop through the users array and render a row for each */}
                  {users.map((user) => (
                    <tr key={user.id}>
                      <td>{user.id}</td>
                      <td>{user.username}</td>
                      <td>{user.email}</td>
                      <td>{new Date(user.created_at).toLocaleString()}</td>
                    </tr>
                  ))}
                </tbody>
              </table>
            </div>
          )}
        </div>
      </div>
    </div>
  );
}