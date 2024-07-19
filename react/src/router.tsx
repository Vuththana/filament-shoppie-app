import { createBrowserRouter } from "react-router-dom";
import Login from "./views/Login";
import Users from "./views/Users";
import Signup from "./views/Signup";
import NotFound from "./views/NotFound";

const route = createBrowserRouter([
    {
        path:'/login',
        element:<Login />
    },
    {
        path:'/signup',
        element:<Signup />
    },
    {
        path:'*',
        element:<NotFound />
    },

])

export default route;