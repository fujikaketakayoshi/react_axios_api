import axios from 'axios';
import React from "react";

const getURL = "http://localhost/live_coding_react/react/axios_api/public/api/get.php?id=1";
const postURL = "http://localhost/live_coding_react/react/axios_api/public/api/post.php";
const putURL = "http://localhost/live_coding_react/react/axios_api/public/api/put.php";
const deleteURL = "http://localhost/live_coding_react/react/axios_api/public/api/delete.php";

export default function App() {
    const [post, setPost] = React.useState(null);
    
    React.useEffect(() => {
        axios.get(getURL).then((response) => {
            setPost(response.data);
        });
    }, []);
    
    function createPost() {
        const data = {
                    title: "Hello, World2",
                    body: "This is a new post."
                };
        axios
            .post(postURL,
                data,
                {headers: { "Content-type": "application/json" }}
            )
            .then((response) => {
                setPost(response.data);
            });
            //{headers: { "Content-type": "application/x-www-form-urlencoded" }}
    }
    
    function updatePost(e) {
        const data = {
            id: e.currentTarget.getAttribute('data-id'),
            title: "update World",
            body: "This is a updated post."
        };
        axios
            .put(putURL,data)
            .then((response) => {
                setPost(response.data);
            });
    }
    
    function deletePost(e) {
        const data = {
                id: e.currentTarget.getAttribute('data-id')
        };
        axios
            .delete(deleteURL, 
                {data: data})
            .then(() => {
                alert("Post deleted!");
                setPost(null);
            });
    }
    
    if (!post) return "No post!";
    
    return (
        <div>
            <h1>{post.title}</h1>
            <p>{post.body}</p>
            <button onClick={createPost}>Create Post</button>
            <button onClick={updatePost} data-id={post.id}>Update Post</button>
            <button onClick={deletePost} data-id={post.id}>Delete Post</button>
        </div>
    );
}
