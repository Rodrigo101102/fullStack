import React from "react";
import "../css/footer.css";  // ✅ Ahora apunta a `components/css/`

const Footer = () => {
    return (
        <footer>
            <p>&copy; {new Date().getFullYear()} Mi Sitio Web. Todos los derechos reservados.</p>
        </footer>
    );
};

export default Footer;
