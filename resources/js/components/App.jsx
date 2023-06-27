import React from 'react';
import { createRoot } from "react-dom/client";

function App() {
    return (
        <div className="container">
            <div className="row justify-content-center">
                <div className="col-md-8">
                    <div className="card">
                        <div className="card-header">Example Component By Ahmad</div>

                        <div className="card-body">I'm an example component! By Ahmad</div>
                    </div>
                </div>
            </div>
        </div>
    );
}

export default App;

/*if (document.getElementById('root')) {
    const rootElement = document.getElementById("root");
    const root = createRoot(rootElement);
    root.render(
    <React.StrictMode>
        <App />
    </React.StrictMode>
    );
}*/
