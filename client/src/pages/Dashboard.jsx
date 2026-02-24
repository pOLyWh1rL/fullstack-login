import { useEffect, useState } from 'react';
import { useNavigate, Link } from 'react-router-dom';

export default function Dashboard() {
  const [username, setUsername] = useState('');
  const navigate = useNavigate();

  // This runs automatically when the component mounts
  useEffect(() => {
    // Check if there is a logged-in user in local storage
    const loggedInUser = localStorage.getItem('user');
    
    if (!loggedInUser) {
      // If no user is found, redirect back to the login page
      navigate('/login');
    } else {
      // Set the username state to display it on the page
      setUsername(loggedInUser);
    }
  }, [navigate]);

  const handleLogout = () => {
    // Clear the session data
    localStorage.removeItem('user');
    // Send the user back to the login screen
    navigate('/login');
  };

  return (
    <div className="container mt-5">
      <div className="row justify-content-center">
        <div className="col-md-8">
          <div className="card shadow">
            <div className="card-body text-center p-5">
              <h1 className="display-4 text-primary mb-3">Dashboard</h1>
              <p className="lead">
                Welcome back, <strong>{username}</strong>! You are successfully logged in.
              </p>
              
              <hr className="my-4" />
              
              <p className="text-muted mb-4">
                This is a protected route. Only authenticated users can see this page.
              </p>
              
              <div className="d-grid gap-2 d-sm-flex justify-content-sm-center">
                {/* A link to navigate to the User List page */}
                <Link to="/users" className="btn btn-outline-primary px-4 gap-3">
                  View All Users
                </Link>
                
                {/* Logout Button */}
                <button 
                  onClick={handleLogout} 
                  className="btn btn-danger px-4"
                >
                  Logout
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
}