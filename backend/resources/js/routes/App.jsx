import React from "react";
import { BrowserRouter as Router, Routes, Route } from "react-router-dom";
import Navbar from "../components/partials/Navbar";
import Footer from "../components/partials/Footer";
import Home from "../components/pages/home";
import About from "../components/pages/about";
import Compras from "../components/pages/compras";
import Producto from "../components/pages/producto"; // ✅ Página de productos
import NotFound from "../components/pages/NotFound"; // Para manejar rutas inexistentes

const App = () => {
    return (
        <Router>
            <Navbar />
            <div style={{ paddingBottom: "50px" }}> {/* Para evitar que el footer cubra contenido */}
                <Routes>
                    <Route path="/" element={<Home />} />
                    <Route path="/about" element={<About />} />
                    <Route path="/producto" element={<Producto />} /> {/* ✅ Agregamos la ruta */}
                    <Route path="/compras" element={<Compras />} />
                    <Route path="/contact" element={<h1>Contacto</h1>} />
                    <Route path="*" element={<NotFound />} />
                </Routes>
            </div>
            <Footer />
        </Router>
    );
};

export default App;
