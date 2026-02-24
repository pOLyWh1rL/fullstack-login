import { useState } from 'react';
import { useNavigate } from 'react-router-dom';

export default function Register() {
  // State to hold form data and messages
  const [username, setUsername] = useState('');
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');
  const [message, setMessage] = useState('');
  const [isSuccess, setIsSuccess] = useState(false);
  const navigate = useNavigate();

  const handleRegister = async (e) => {
    e.preventDefault();
    setMessage(''); // Clear previous messages
    
    try {
      // Call the PHP REST API
      const response = await fetch('http://localhost/fullstack-login/api/register.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ username, email, password })
      });
      
      const data = await response.json();
      
      if (data.status === 'success') {
        setIsSuccess(true);
        setMessage('Registration successful! Redirecting to login...');
        // Redirect to the login page after 2 seconds
        setTimeout(() => navigate('/login'), 2000);
      } else {
        setIsSuccess(false);
        setMessage(data.message);
      }
    } catch (error) {
      setIsSuccess(false);
      setMessage('Error connecting to the server. Is XAMPP running?');
    }
  };

  return (
    <div className="container mt-5">
      <div className="row justify-content-center">
        <div className="col-md-6">
          <div className="card shadow">
            <div className="card-body">
              <h2 className="text-center mb-4">Register</h2>
              
              {/* Display success or error messages dynamically */}
              {message && (
                <div className={`alert ${isSuccess ? 'alert-success' : 'alert-danger'}`}>
                  {message}
                </div>
              )}
              
              <form onSubmit={handleRegister}>
                <div className="mb-3">
                  <label className="form-label">Username</label>
                  <input 
                    type="text" 
                    className="form-control" 
                    value={username}
                    onChange={(e) => setUsername(e.target.value)}
                    required 
                  />
                </div>
                <div className="mb-3">
                  <label className="form-label">Email address</label>
                  <input 
                    type="email" 
                    className="form-control" 
                    value={email}
                    onChange={(e) => setEmail(e.target.value)}
                    required 
                  />
                </div>
                <div className="mb-3">
                  <label className="form-label">Password</label>
                  <input 
                    type="password" 
                    className="form-control" 
                    value={password}
                    onChange={(e) => setPassword(e.target.value)}
                    required 
                  />
                </div>
                <button type="submit" className="btn btn-success w-100">
                  Create Account
                </button>
              </form>
              
              <div className="text-center mt-3">
                <a href="/login" className="text-decoration-none">Already have an account? Login here</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
}