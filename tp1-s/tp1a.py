from token import RIGHTSHIFT
import gym 
env=gym.make("FrozenLake-v1", render_mode='human')
state = env.reset()
num_timesteps = 20

random_action=env.action_space.sample()
cont=env.step(random_action)

for i in range(num_timesteps):
    env.reset()
    while env.step(random_action)[2] == False:
        random_action = env.action_space.sample()
        env.render()
#nombre de case 
#print(env.observation_space)
#probaliber de la case pour aller a tell endorit s
#print(env.env.P[0][2])
env.close()