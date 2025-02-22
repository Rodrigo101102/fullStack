import React from "react";
import { Link } from "react-router-dom";
import "../css/navbar.css";  // Importamos el CSS

const Navbar = () => {
    const goToRegister = () => {
        window.location.href = "/register"; // ✅ Redirección manual al backend
    };

    const goToLogin = () => {
        window.location.href = "/login"; // ✅ Redirección manual al backend
    };

    return (
        <nav>
            <ul>
                <li><Link to="/">Inicio</Link></li>
                <li><Link to="/about">Acerca de</Link></li>
                <li><Link to="/contact">Contacto</Link></li>
                <li><Link to="/producto">Producto</Link></li>
                <li><Link to="/compras">Compras</Link></li>
                <li><a href="/register" target="_blank" rel="noopener noreferrer">Registrar</a></li> 
                <li><a href="/login" target="_blank" rel="noopener noreferrer">Login</a></li> 
            </ul>
        </nav>
    );
};

export default Navbar;
