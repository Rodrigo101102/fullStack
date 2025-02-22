import React from "react";
import { createRoot } from "react-dom/client";
import App from "./routes/App.jsx";  // ✅ Ruta corregida

const root = document.getElementById("app");

if (root) {
    createRoot(root).render(<App />);
}
