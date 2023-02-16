import axios from 'axios';
import React from "react";

const postsURL = "http://localhost/live_coding_react/react/axios_api/public/api/posts.php?id=1";
const postURL = "http://localhost/live_coding_react/react/axios_api/public/api/post.php";

export default function App() {
    const [post, setPost] = React.useState(null);
    
    React.useEffect(() => {
        axios.get(postsURL).then((response) => {
            setPost(response.data);
        });
    }, []);
    
    function createPost() {
        const data = {
                    title: "Hello, World",
                    body: "This is a new post."
                };
        axios
            .post(postURL,
                data,
                {headers: { "Content-type": "application/x-www-form-urlencoded" }}
            )
            .then((response) => {
                setPost(response.data);
            });
    }
    
    if (!post) return "No post!";
    
    return (
        <div>
            <h1>{post.title}</h1>
            <p>{post.body}</p>
            <button onClick={createPost}>Create Post</button>
        </div>
    );
}
