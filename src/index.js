import { render, Component } from "@wordpress/element";
import Hello from "./components/Hello";

class App extends Component {
  render() {
    return (
      <>
        <h2>MCQ Quiz system</h2>
        <Hello />
      </>
    );
  }
}

render(<App />, document.getElementById("react-app"));
