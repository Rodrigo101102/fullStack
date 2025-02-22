import React, { useEffect, useState } from "react";
import "../css/compras.css"; 

const Compras = () => {
    const [carrito, setCarrito] = useState({});

    useEffect(() => {
        const carritoGuardado = JSON.parse(localStorage.getItem("carrito")) || {};
        setCarrito(carritoGuardado);
    }, []);

    const eliminarDelCarrito = (id) => {
        const nuevoCarrito = { ...carrito };
        delete nuevoCarrito[id];
        setCarrito(nuevoCarrito);
        localStorage.setItem("carrito", JSON.stringify(nuevoCarrito));
    };

    return (
        <div className="compras-container">
            <h1>🛒 Mis Compras</h1>

            {Object.keys(carrito).length > 0 ? (
                <ul className="compras-lista">
                    {Object.values(carrito).map((item) => (
                        <li key={item.id} className="compras-item">
                            <img src={`http://127.0.0.1:8000/${item.imagen}`} alt={item.nombre} className="compras-img" />
                            <div>
                                <h3>{item.nombre}</h3>
                                <p>Precio: S/. {item.precio}</p>
                                <p>Cantidad: {item.cantidad}</p>
                                <button className="btn-eliminar" onClick={() => eliminarDelCarrito(item.id)}>❌ Eliminar</button>
                            </div>
                        </li>
                    ))}
                </ul>
            ) : (
                <p>Tu carrito está vacío.</p>
            )}
        </div>
    );
};

export default Compras;
